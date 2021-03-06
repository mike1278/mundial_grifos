<?php

namespace App\Rules;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\UncompromisedVerifier;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Password implements Rule, DataAwareRule
{
    /**
     * The data under validation.
     *
     * @var array
     */
    protected array $data;

    /**
     * The minimum size of the password.
     *
     * @var int
     */
    protected mixed $min = 8;

    /**
     * If the password requires at least one uppercase and one lowercase letter.
     *
     * @var bool
     */
    protected bool $mixedCase = false;

    /**
     * If the password requires at least one letter.
     *
     * @var bool
     */
    protected bool $letters = false;

    /**
     * If the password requires at least one number.
     *
     * @var bool
     */
    protected bool $numbers = false;

    /**
     * If the password requires at least one symbol.
     *
     * @var bool
     */
    protected bool $symbols = false;

    /**
     * If the password should has not been compromised in data leaks.
     *
     * @var bool
     */
    protected bool $uncompromised = false;

    /**
     * The number of times a password can appear in data leaks before being consider compromised.
     *
     * @var int
     */
    protected int $compromisedThreshold = 0;

    /**
     * The failure messages, if any.
     *
     * @var array
     */
    protected array $messages = [];

    /**
     * The callback that will generate the "default" version of the password rule.
     *
     * @var string|array|callable|null
     */
    public static $defaultCallback;

    /**
     * Create a new rule instance.
     *
     * @param int $min
     * @return void
     */
    public function __construct(int $min)
    {
        $this->min = max($min, 1);
    }

    /**
     * Set the default callback to be used for determining a password's default rules.
     *
     * If no arguments are passed, the default password rule configuration will be returned.
     *
     * @param \Illuminate\Validation\Rules\Password|callable|null $callback
     * @return static|null
     */
    public static function defaults($callback = null): static
    {
        if (is_null($callback)) {
            return static::default();
        }

        if (!is_callable($callback) && !$callback instanceof static) {
            throw new InvalidArgumentException('The given callback should be callable or an instance of ' . static::class);
        }

        static::$defaultCallback = $callback;
    }

    public static function default(): Rule|static
    {
        $password = value(static::$defaultCallback);

        return $password instanceof Rule ? $password : static::min(8);
    }

    /**
     * Get the default configuration of the password rule and mark the field as required.
     *
     * @return array
     */
    public static function required(): array
    {
        return ['required', static::default()];
    }

    /**
     * Get the default configuration of the password rule and mark the field as sometimes being required.
     *
     * @return array
     */
    public static function sometimes(): array
    {
        return ['sometimes', static::default()];
    }

    /**
     * Set the data under validation.
     *
     * @param array $data
     * @return $this
     */
    public function setData($data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Sets the minimum size of the password.
     *
     * @param int $size
     * @return $this
     */
    public static function min(int $size): static
    {
        return new static($size);
    }

    /**
     * Ensures the password has not been compromised in data leaks.
     *
     * @param int $threshold
     * @return $this
     */
    public function uncompromised(int $threshold = 0): static
    {
        $this->uncompromised = true;

        $this->compromisedThreshold = $threshold;

        return $this;
    }

    /**
     * Makes the password require at least one uppercase and one lowercase letter.
     *
     * @return $this
     */
    public function mixedCase(): static
    {
        $this->mixedCase = true;

        return $this;
    }

    /**
     * Makes the password require at least one letter.
     *
     * @return $this
     */
    public function letters(): static
    {
        $this->letters = true;

        return $this;
    }

    /**
     * Makes the password require at least one number.
     *
     * @return $this
     */
    public function numbers(): static
    {
        $this->numbers = true;

        return $this;
    }

    /**
     * Makes the password require at least one symbol.
     *
     * @return $this
     */
    public function symbols(): static
    {
        $this->symbols = true;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws BindingResolutionException
     */
    public function passes($attribute, $value): bool
    {
        $validator = Validator::make($this->data, [
            $attribute => 'string|min:' . $this->min,
        ]);

        if ($validator->fails()) {
            return $this->fail($validator->messages()->all());
        }

        $value = (string)$value;

        if ($this->mixedCase && !preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value)) {
            $this->fail('password_letter_uppercase_lowercase');
        }

        if ($this->letters && !preg_match('/\pL/u', $value)) {
            $this->fail('password_letter');
        }

        if ($this->symbols && !preg_match('/\p{Z}|\p{S}|\p{P}/u', $value)) {
            $this->fail('password_symbol');
        }

        if ($this->numbers && !preg_match('/\pN/u', $value)) {
            $this->fail('password_number');
        }

        if (!empty($this->messages)) {
            return false;
        }

        if ($this->uncompromised && !Container::getInstance()->make(UncompromisedVerifier::class)->verify([
                'value' => $value,
                'threshold' => $this->compromisedThreshold,
            ])) {
            return $this->fail(
                'different_password'
            );
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function message(): array
    {
        return $this->messages;
    }

    /**
     * Adds the given failures, and return false.
     *
     * @param array|string $messages
     * @return bool
     */
    protected function fail(array|string $messages): bool
    {
        $messages = collect(Arr::wrap($messages))->map(function ($message) {
            return __('validation.'.$message);
        })->all();

        $this->messages = array_merge($this->messages, $messages);

        return false;
    }
}
