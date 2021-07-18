import { helpers } from 'vuelidate/lib/validators'

const accepted = (value) => value === true
const boolean = (value) => value === true || value === false
const phone = helpers.regex('phone', /^0?(414|412|416|426|424|2)(\d{7,9})$/)
const alphaSpace = helpers.regex('alphaSpace', /^[a-zA-Z ñ]*$/)
const date = helpers.regex(
  'date',
  /^(20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/
)
const extensionFile = (param) =>
  helpers.withParams({ type: 'extension validation', value: param }, (value) =>
    param.includes(
      value != null
        ? value.name
            .slice(((value.name.lastIndexOf('.') - 1) >>> 0) + 2)
            .toLowerCase()
        : -1
    )
  )
const MaxSizeFile = (param) =>
  helpers.withParams({ type: 'max size file', value: param }, (value) =>
    value != null ? value.size / 1048576 < param : false
  )
const In = (param) =>
  helpers.withParams({ type: 'in value inserted', value: param }, (value) =>
    value != null ? param.includes(value) : false
  )

export {
  accepted,
  boolean,
  phone,
  alphaSpace,
  extensionFile,
  MaxSizeFile,
  In,
  date,
}
