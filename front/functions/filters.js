export function filters(filters, query) {
  let filter = ''
  if (Array.isArray(filters)) {
    filters.forEach((el) => {
      if (Object.prototype.hasOwnProperty.call(query, el)) {
        if (!query[el]) {
          return
        }
        if (filter !== '') {
          filter += `
          `
        }
        filter +=
          '{ column:' +
          el.toUpperCase() +
          '_ID' +
          ', operator: EQ, value:' +
          query[el] +
          '}'
      }
    })
    if (filter !== '') {
      filter = `where: {
            AND: [
              ${filter}
            ]
        }`
    }
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
