
let min = 0;
let max = 10000000000;

const calcLeftPosition = value => 100 / 10000000000 * value;

$('#rangeMin').on('input', function(e) {
    const newValue = parseInt(e.target.value);
    if (newValue > max) return;
    min = newValue;
    $('#thumbMin').css('left', calcLeftPosition(newValue) + '%');
    //get value old
    let old = $('.value-selected').text().split(" - ");
    let unit = '';
    if (newValue > 1000000000) {
        old[0] = (newValue/1000000000).toFixed(2);
        unit = 'Tỷ';
    } else if (newValue > 1000000) {
        old[0] = (newValue/1000000).toFixed(2);
        unit = 'Triệu';
    } else if (newValue > 1000) {
        old[0] = (newValue/1000).toFixed(2);
        unit = 'Nghìn';
    } else if (newValue === 0) {
        old[0] = 0;
        unit = 'Nghìn';
    }
    old[0] = old[0] > 0 ? parseInt(parseFloat(old[0]) * 100)/100 : 0;
    $('.value-selected').html(old[0] + unit + ' - ' + old[1]);
    $('#line').css({
        'left': calcLeftPosition(newValue) + '%',
        'right': (100 - calcLeftPosition(max)) + '%'
    });
});

$('#rangeMax').on('input', function(e) {
    const newValue = parseInt(e.target.value);
    if (newValue < min) return;
    max = newValue;
    $('#thumbMax').css('left', calcLeftPosition(newValue) + '%');
    //get value old
    let old = $('.value-selected').text().split(" - ");
    let unit = '';
    if (newValue > 1000000000) {
        old[1] = (newValue/1000000000).toFixed(2);
        unit ='Tỷ';
    } else if (newValue > 1000000) {
        old[1] = (newValue/1000000).toFixed(2);
        unit = 'Triệu';
    } else if (newValue > 1000) {
        old[1] = (newValue/1000).toFixed(2);
        unit = 'Ngìn';
    } else if (newValue === 0) {
        old[1] = 0;
        unit = 'Nghìn';
    }
    old[1] = old[1] > 0 ? parseInt(parseFloat(old[1]) * 100)/100 : 0;
    $('.value-selected').html(old[0] + ' - ' + old[1] + unit);
    $('#line').css({
        'left': calcLeftPosition(min) + '%',
        'right': (100 - calcLeftPosition(newValue)) + '%'
    });
});

$('#rangeMin').trigger('input');
$('#rangeMax').trigger('input');
