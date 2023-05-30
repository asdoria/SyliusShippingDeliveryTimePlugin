/**
 *
 * @param selector
 */
export default (selector = '.asdoria-shipment-delivery-time[data-next-shipment-date]') => {
    const els = document.querySelectorAll(selector).forEach(el => {
        const { nextShipmentDate } = el ? el.dataset : {}

        if (!nextShipmentDate) return

        const endDate = Date.parse(nextShipmentDate)

        if (!endDate) return
        el.style.display = 'flex'

        setInterval(() => calculate(endDate, el), 1000)
        calculate(endDate, el)
    })
}

/**
 *
 * @param endDate
 * @param el
 */
const calculate = (endDate, el) => {
    const currentDate = ( new Date() ).getTime()

    let timeRemaining = parseInt(( endDate - currentDate ) / 1000, 10)
    if (timeRemaining < 0) return

    const days = parseInt(timeRemaining / 86400, 10)
    timeRemaining %= 86400

    const hours = parseInt(timeRemaining / 3600, 10)
    timeRemaining %= 3600

    const minutes = parseInt(timeRemaining / 60, 10)
    timeRemaining %= 60

    const seconds = parseInt(timeRemaining, 10)


    if (el.querySelector('.days')) {
        el.querySelector('.days').style.display = days > 0 ? 'block' : ''
        el.querySelector('.days').innerText     = String(days).padStart(2, '0');
    }
    if (el.querySelector('.hours')) {
        el.querySelector('.hours').innerText = String(hours).padStart(2, '0');
    }
    if (el.querySelector('.minutes')) {
        el.querySelector('.minutes').innerText = String(minutes).padStart(2, '0');
    }
    if (el.querySelector('.seconds')) {
        el.querySelector('.seconds').innerText = String(seconds).padStart(2, '0');
    }
}
