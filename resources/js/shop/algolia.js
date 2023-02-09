import algoliasearch from 'algoliasearch'
import instantsearch from 'instantsearch.js'
import {
    clearRefinements,
    configure,
    currentRefinements,
    hits,
    numericMenu,
    pagination,
    panel,
    poweredBy,
    refinementList,
    sortBy
} from 'instantsearch.js/es/widgets'
import { connectSearchBox } from 'instantsearch.js/es/connectors'
import { hitsEmpty, hitsItem, refinementListItem } from './algolia-templates'
import { debounce } from 'lodash'

function renderSearchBox (renderOptions, isFirstRender) {
    const { query, refine, clear, isSearchStalled, widgetParams } = renderOptions

    if (isFirstRender) {
        const searchBox = document.querySelector('#searchBoxTemplate').content.cloneNode(true)
        widgetParams.container.appendChild(searchBox)

        const input = widgetParams.container.querySelector('input')
        input.addEventListener('input', event => {
            refine(event.target.value)
        })

        const clearButton = widgetParams.container.querySelector('button[data-action=clear]')
        clearButton.addEventListener('click', clear)

        const searchButton = widgetParams.container.querySelector('button[data-action=search]')
        searchButton.addEventListener('click', () => {
            refine(input.value)
        })
    }

    widgetParams.container.querySelector('input').value = query
    widgetParams.container.querySelector('span').hidden = !isSearchStalled
}

const customSearchBox = connectSearchBox(
    renderSearchBox
)

const panelCssClasses = {
    root: ['mb-2', 'mb-md-4'],
    header: ['fs-5']
}

const categoriesRefinementListPanel = panel({
    cssClasses: panelCssClasses,
    templates: {
        header: 'Категории',
    },
    hidden ({ canRefine }) {
        return !canRefine
    },
})(refinementList)

const currentRefinementsPanel = panel({
    cssClasses: panelCssClasses,
    templates: {
        header: 'Примененные фильтры',
    },
    hidden ({ canRefine }) {
        return !canRefine
    },
})(currentRefinements)

const numericMenuPanel = panel({
    cssClasses: panelCssClasses,
    templates: {
        header: 'Цена',
    },
})(numericMenu)

function formatPrice (priceAsInt, locale = 'ru-RU', withPennies = true) {
    const price = priceAsInt / 100

    const formatterOptions = {
        style: 'currency',
        currency: 'RUB'
    }

    if (!withPennies) {
        formatterOptions.maximumFractionDigits = 0
        formatterOptions.minimumFractionDigits = 0
    }

    return new Intl.NumberFormat(locale, formatterOptions).format(price)
}

function translateItemLabel (item) {
    const translations = {
        categories: 'категория',
        price: 'цена'
    }

    return {
        ...item,
        label: translations[item.label] ?? item.label,
    }
}

function formatRefinementListItemPrice (item, locale) {
    return {
        ...item,
        refinements: item.refinements.map(refinement => ({
            ...refinement,
            label: refinement.label.replace(/\d+/g, formatPrice(refinement.value, locale, false))
        }))
    }
}

function transformHitsItems (items) {
    return items.map(item => ({
        ...item,
        price: formatPrice(item.price)
    }))
}

function initialize (options) {
    const { appId, apiKey, indexName, shopUrl, storageUrl, imageNotFoundUrl, hitsPerPage } = options

    const searchClient = algoliasearch(appId, apiKey)

    const search = instantsearch({
        indexName,
        searchClient,
        routing: true,
    })

    search.addWidgets([
        configure({
            hitsPerPage,
        }),
        customSearchBox({
            container: document.querySelector('#search-box'),
            queryHook: debounce((query, search) => search(query), 500)
        }),
        hits({
            container: '#hits',
            cssClasses: {
                list: ['row', 'row-cols-2', 'row-cols-lg-3', 'g-3', 'list-style-none', 'p-0'],
                item: ['col']
            },
            transformItems: transformHitsItems,
            templates: {
                item: hitsItem.bind(null, { storageUrl, shopUrl, imageNotFoundUrl }),
                empty: hitsEmpty,
            },
        }),
        categoriesRefinementListPanel({
            container: '#categories-refinement-list',
            attribute: 'categories',
            cssClasses: {
                list: ['p-0'],
                item: ['list-style-none'],
            },
            templates: {
                item: refinementListItem,
            }
        }),
        currentRefinementsPanel({
            container: '#current-refinements',
            transformItems (items) {
                return items.map(item => {
                    item = translateItemLabel(item)

                    if (item.attribute === 'price') {
                        item = formatRefinementListItemPrice(item)
                    }

                    return item
                })
            },
            cssClasses: {
                list: ['p-0'],
                item: ['d-flex', 'flex-wrap', 'align-items-center', 'gap-1', 'mb-2'],
                category: ['badge', 'rounded-pill', 'bg-primary', 'd-flex', 'justify-content-center', 'align-items-center', 'px-2'],
                delete: ['bg-transparent', 'border-0', 'text-white']
            }
        }),
        numericMenuPanel({
            container: '#price-numeric-menu',
            attribute: 'price',
            items: [
                { label: 'Любая' },
                { label: 'Меньше 20 000 \u20bd', end: 20_000_00 },
                { label: '20 000 \u20bd - 50 000 \u20bd', start: 20_000_00, end: 50_000_00 },
                { label: '50 000 \u20bd - 100 000 \u20bd', start: 50_000_00, end: 100_000_00 },
                { label: '100 000 \u20bd - 150 000 \u20bd', start: 100_000_00, end: 150_000_00 },
                { label: 'Больше 150 000 \u20bd', start: 150_000_00 },
            ],
            cssClasses: {
                list: ['p-0'],
                item: ['list-style-none'],
                label: ['form-check-label', 'fs-6'],
                radio: ['form-check-input', 'me-1']
            }
        }),
        clearRefinements({
            container: '#clear-refinements',
            cssClasses: {
                button: ['btn', 'btn-primary', 'mb-3', 'mb-md-4', 'w-100']
            },
            templates: {
                resetLabel: 'Сбросить фильтры'
            }
        }),
        pagination({
            container: '#pagination',
            cssClasses: {
                list: ['pagination'],
                item: ['page-item'],
                disabledItem: ['disabled'],
                selectedItem: ['active'],
                link: ['page-link']
            }
        }),
        poweredBy({
            container: '#powered-by'
        }),
        sortBy({
            container: '#sort-by-price',
            items: [
                { label: 'По умолчанию', value: indexName },
                { label: 'Сначала дешевые', value: `${indexName}_price_asc` },
                { label: 'Сначала дорогие', value: `${indexName}_price_desc` },
            ],
            cssClasses: {
                select: ['form-select']
            }
        }),
    ])

    search.start()
}

function showError () {
    const error = document.querySelector('#error').content.cloneNode(true)
    document.querySelector('#error-container').appendChild(error)
}

window.initializeAlgolia = function (options) {
    try {
        initialize(options)
    } catch (e) {
        showError()
        console.error(e)
    }
}
