export function filters(filters, query) {
  let filter = ''
  if (Array.isArray(filters)) {
    filters.forEach((el) => {
      if (Object.prototype.hasOwnProperty.call(query, el)) {
        filter += filter !== '' ? '&' : ''
        filter += 'filter[' + el + ']=' + query[el]
      }
    })
  }
  return filter
}

export function params(params, query) {
  let param = ''
  if (Array.isArray(params)) {
    params.forEach((el) => {
      if (Object.prototype.hasOwnProperty.call(query, el)) {
        param += param !== '' ? '&' : ''
        param += el + '=' + query[el]
      }
    })
  }
  return param
}
