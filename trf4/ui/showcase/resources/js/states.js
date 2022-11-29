function r(id, name) {
    return {
        id: id,
        name: name
    }
}

function getCountryStates(country) {
    var data = fetchStates(country);
    return data;
}

function fetchStates(country) {
    var data = [
        r('1', '11'),
        r('2', '12'),
        r('3', '21'),
        r('4', '22'),
        ].filter(r => r.name.substr(0, country.length) == country);
    return data;
}