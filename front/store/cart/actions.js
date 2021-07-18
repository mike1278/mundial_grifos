import gql from 'graphql-tag'

const actions = {
  getActiveOrder({ commit }) {
    if (!this.$auth.loggedIn) return
    this.app.apolloProvider.defaultClient
      .query({
        fetchPolicy: 'network-only',
        query: gql`
          {
            activeOrder {
              id
              viewed
              address_id
              note
              note_shop
              delivery_type
              client_id
              state_id
              complete
              created_at
              orderProducts {
                price
                discount
                quantity
                product_color_id
                product_id
                color {
                  name
                  image {
                    url
                  }
                }
                product {
                  id
                  name
                  description
                  serial_code
                  images {
                    url
                  }
                  category {
                    name
                  }
                  brand {
                    name
                  }
                  model {
                    name
                  }
                }
              }
            }
          }
        `,
      })
      .then((res) => {
        commit('activeOrder', res.data.activeOrder)
      })
      .catch(() => {})
  },
  async setProduct({ dispatch }, data) {
    return await this.$axios
      .$post(`/orders/products/${data.id}`, {
        quantity: data.quantity,
        product_color_id: data.color_id,
      })
      .then((result) => {
        dispatch('getActiveOrder')
        return result
      })
  },
  async deleteProduct({ dispatch }, data) {
    return await this.$axios
      .$delete(`/orders/products/${data.id}`)
      .then((result) => {
        dispatch('getActiveOrder')
        return result
      })
  },
  async updateQuantity({ dispatch }, data) {
    return await this.$axios
      .$put(`/orders/products/${data.id}`, {
        quantity: data.quantity,
        color_id: data.color_id,
      })
      .then((result) => {
        dispatch('getActiveOrder')
        return result
      })
  },
}
export default actions
