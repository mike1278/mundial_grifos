import gql from 'graphql-tag'

export const state = () => ({
  currency: null,
  currentCurrency: null,
})

export const mutations = {
  currency(state, value) {
    state.currency = value
  },
  currentCurrency(state, value) {
    state.currentCurrency = value
  },
}

export const actions = {
  async nuxtServerInit({ dispatch }) {
    await dispatch('getCurrencies')
  },
  async getCurrencies({ commit }) {
    await this.app.apolloProvider.defaultClient
      .query({
        fetchPolicy: 'network-only',
        query: gql`
          {
            firstCurrency {
              symbol
              name
              acronym
              rates {
                rate
                toCurrency {
                  symbol
                  name
                }
              }
            }
          }
        `,
      })
      .then((res) => {
        commit('currency', res.data.firstCurrency)
      })
      .catch(() => {})
  },
}

export const getters = {
  currency(state) {
    if (state.currentCurrency) {
      return state.currentCurrency
    }
    return {
      name: state.currency.name,
      symbol: state.currency.symbol,
      rate: 1,
    }
  },
  currencies(state) {
    const currencies = [
      {
        name: state.currency.name,
        symbol: state.currency.symbol,
        rate: 1,
      },
    ]
    state.currency.rates.forEach((el) => {
      currencies.push({
        name: el.toCurrency.name,
        symbol: el.toCurrency.symbol,
        rate: el.rate,
      })
    })
    return currencies
  },
}
