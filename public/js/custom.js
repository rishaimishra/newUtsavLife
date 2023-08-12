$("#services_qwe").change(function () {
    var selected = [];
    var x = document.getElementsByName('order_belongstomany_service__crud_relationship[]')
    for (var option of document.getElementsByName('order_belongstomany_service__crud_relationship[]')[0].options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    fetch(`/get-tot-price/${selected}`)
        .then(response => response.json())
        .then(data => {
            console.log(data.tot_price);
            var y = document.getElementById('total_price')
            y.children.total_price.value = data.tot_price

        });
});
