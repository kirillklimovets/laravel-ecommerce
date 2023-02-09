export function hitsItem (routes, data) {
    const { storageUrl, shopUrl, imageNotFoundUrl } = routes
    const { price, name, details, image, slug } = data

    return `
        <div class="card px-2 px-md-3 pt-2">
            <img src="${image ? storageUrl + '/' + image : imageNotFoundUrl}" alt="${name}" class="mb-3 product-card-image">
            <div class="card-body py-0 py-md-3 pb-3">
                <a href="${shopUrl}/${slug}" class="text-decoration-none stretched-link">
                    <h5 class="card-title text-truncate fs-6">${name}</h5>
                </a>
                <div class="card-text">
                    <p class="text-muted product-card-details">${details}</p>
                    <p class="fs-5 mb-0">${price}</p>
                </div>
            </div>
        </div>
    `
}

export const hitsEmpty = `
    <div class="d-flex flex-column align-items-center mt-5 text-muted text-truncate gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor"
             class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <div class="text-center">
            <p class="fs-5 m-0">Товаров не найдено</p>
            <p>Попробуйте изменить настройки поиска</p>
        </div>
    </div>
`

export const refinementListItem = `
    <div class="d-flex align-items-center">
        <input class="form-check-input m-0 me-2" type="checkbox" {{#isRefined}}checked{{/isRefined}}>
        <a href="{{url}}" class="text-decoration-none fs-6">
            {{label}} <span class="badge rounded-pill bg-warning text-black">{{count}}</span>
        </a>
    </div>
`
