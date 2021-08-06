function fnpwp(value) {
    value = value.replace(/[A-Za-z\W\s_]+/g, '');
    let split = 6;
    const dots = [];

    for (let i = 0, len = value.length; i < len; i += split) {
        split = i >= 2 && i <= 6 ? 3 : i >= 8 && i <= 12 ? 4 : 2;
        dots.push(value.substr(i, split));
    }

    const temp = dots.join('.');
    return temp.length > 12 ? `${temp.substr(0, 12)}-${temp.substr(12, 7)}` : temp;
}

$(document).on('keyup', '.npwp', function() {
    $(this).val(fnpwp($(this).val()))
})

function fnumber(bilangan, prefix) {
    var number_string = String(bilangan).replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        sisa    = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
        
    if(ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

$(document).on('keyup', '.number', function() {
    $(this).val(fnumber($(this).val()))
})

function frtn(rupiah) {
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}

function fntr(param) {
	return 'Rp' + new Intl.NumberFormat('id-ID').format(param)
}
