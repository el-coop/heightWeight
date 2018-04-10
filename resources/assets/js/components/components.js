import {BulmaAccordion, BulmaAccordionItem} from 'vue-bulma-accordion';

Vue.component('bulma-accordion', BulmaAccordion);
Vue.component('bulma-accordion-item', BulmaAccordionItem);

import VueClipboard from 'vue-clipboard2';

Vue.use(VueClipboard);

import Toasted from 'vue-toasted';

Vue.use(Toasted);

import VTooltip from 'v-tooltip';

Vue.use(VTooltip);

require('./global/global');
require('./products/products');
require('./pages/pages');