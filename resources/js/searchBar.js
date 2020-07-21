const algoliasearch = require('algoliasearch/lite');
const instantsearch = require('instantsearch.js').default;
import { searchBox, hits } from 'instantsearch.js/es/widgets';

const searchClient = algoliasearch('4FF6JXK2K0', '86e9c61811af66cf6fc6209ec6715464');

const search = instantsearch({
    indexName: 'products',
    searchClient,
});

search.addWidgets([
    searchBox({
        container: '#searchbox',
    }),

    hits({
        container: '#hits',
    })
]);

search.start();

console.log('yooooooooooo');
