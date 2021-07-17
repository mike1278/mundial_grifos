import numeral from 'numeral';
import 'numeral/locales';

const abbreviate = function abbreviate(value) {
    return numeral(value).format('0.0a');
};

const bytes = function bytes(value) {
    return numeral(value).format('0 b');
};

const exposedNumeral = function exposedNumeral(value, format) {
    return numeral(value).format(format);
};

const exponential = function exponential(value) {
    return numeral(value).format('0.[00]e+0');
};

const ordinal = function ordinal(value) {
    return numeral(value).format('Oo');
};

const percentage = function percentage(value) {
    return numeral(value).format('0.[00]%');
};

const separator = function separator(value) {
    return numeral(value).format('0,0');
};

const currency = function currency(value) {
    return numeral(value).format('$0,0.00');
};

numeral.locale('es-es');

export default {
    abbreviate,
    bytes,
    exposedNumeral,
    exponential,
    ordinal,
    percentage,
    separator,
    currency,
};
