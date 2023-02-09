import { Tooltip } from 'bootstrap'

// Enable tooltips everywhere
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl))
