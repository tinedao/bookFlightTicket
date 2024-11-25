function validateDates(fromDateId, toDateId) {
    var from_date = document.getElementById(fromDateId).value;
    var to_date = document.getElementById(toDateId).value;

    if (from_date === '' || to_date === '') {
        alert('Both dates must be provided.');
        return false;
    }

    if (from_date > to_date) {
        alert('From Date must be earlier than To Date.');
        return false;
    }

    return true;
}
