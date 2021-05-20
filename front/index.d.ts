import { ApolloClient } from 'apollo-client'
import { SubscriptionClient } from 'subscriptions-transport-ws'
import { InMemoryCache } from 'apollo-cache-inmemory'

type VueApolloClient = ApolloClient<InMemoryCache> & {
  wsClient: SubscriptionClient
}

declare module '*.gql' {
  // @ts-ignore
  import { DocumentNode } from 'graphql'

  const content: DocumentNode
  export default content
}

declare module '*.graphql' {
  // @ts-ignore
  import { DocumentNode } from 'graphql'

  const content: DocumentNode
  export default content
}
