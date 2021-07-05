import gql from 'graphql-tag'

const actions = {
  getActiveOrder({ commit }) {
    if (!this.$auth.loggedIn) return
    this.app.apolloProvider.defaultClient
      .query({
        query: gql`
          {
            activeOrder {
              id
              viewed
              address_id
              note
              note_shop
              delivery_type
              products {
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
                pivot {
                  price
                  discount
                  quantity
                  color {
                    name
                    image {
                      url
                    }
                  }
                }
              }
              client_id
              state_id
              complete
              created_at
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
    await this.$axios.$post(`/orders/products/${data.id}`, {
      quantity: data.quantity,
      product_color_id: data.color_id,
    })
    dispatch('getActiveOrder')
  },
  async deleteProduct({ dispatch }, data) {
    await this.$axios.$delete(`/orders/products/${data.id}`)
    dispatch('getActiveOrder')
  },
  async updateQuantity({ dispatch }, data) {
    await this.$axios.$put(`/orders/products/${data.id}`, {
      quantity: data.quantity,
    })
    dispatch('getActiveOrder')
  },
}
export default actions
