let symbols = []
let error = false
let today = new Date()

$(document).ready(function () {
    $('.d-none.symbols').children().each(function() {
        symbols.push($(this).text())
    })

    $('form').submit(function() {
        return !validateForm()
    })

})

function validateForm()
{
    let error1 = validateSymbol()
    let error2 = validateStartDate()
    let error3 = validateEndDate()
    let error4 = validateDates()
    let error5 = validateEmail()
    return error1 || error2 || error3 || error4 || error5
}

function validateSymbol()
{
    let symbolText = $('#symbol').val()
    error = ((symbolText == '') || ($.inArray(symbolText, symbols) === -1))
    if (error) {
        $('#symbol').addClass('is-invalid')
    } else {
        $('#symbol').removeClass('is-invalid')
    }
    return error
}

function validateStartDate()
{
    let startDateText = new Date($('#start-date').val())
    error = ((startDateText == 'Invalid Date') || (startDateText > today))
    if (error) {
        $('#start-date').addClass('is-invalid')
    } else {
        $('#start-date').removeClass('is-invalid')
    }
    return error
}

function validateEndDate()
{
    let endDateText = new Date($('#end-date').val())
    error = ((endDateText == 'Invalid Date') || (endDateText > today))
    if (error)
    {
        $('#end-date').addClass('is-invalid')
    } else {
        $('#end-date').removeClass('is-invalid')
    }
    console.log(error)
    return error
}

function validateDates()
{
    let startDateText = new Date($('#start-date').val())
    let endDateText = new Date($('#end-date').val())
    let startDateValidated = validateStartDate()
    let endDateValidated = validateEndDate()

    error = ( (startDateValidated || endDateValidated) ||
        (startDateText == 'Invalid Date') ||
        (endDateText  == 'Invalid Date') ||
        startDateText > endDateText)
    if (error) {
        $('#start-date').addClass('is-invalid')
        $('#end-date').addClass('is-invalid')
    } else {
        $('#start-date').removeClass('is-invalid')
        $('#end-date').removeClass('is-invalid')
    }
    return error
}

function validateEmail()
{
    let emailText = $('#email').val()
    let re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
    error = (!emailText.match(re))
    if (error) {
        $('#email').addClass('is-invalid')
    } else {
        $('#email').removeClass('is-invalid')
    }
    return error
}
