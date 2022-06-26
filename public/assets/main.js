document.querySelector('#countryForm').onchange = function (){
    fetch('/get-state/'+this.value).then(val=>{
        return val.json();
    }).then(val=>{
        let sendButton = document.querySelector('.f_send');
        let cityFormOption = document.querySelector('.f_cityForm');
        let state = cityFormOption.value = val.state ;
        cityFormOption.innerText = val.state ;

        if(!state)
        {
            sendButton.setAttribute('disabled','disabled');
            return false;
        }
        sendButton.removeAttribute('disabled');
    });
}

document.querySelector('.f_send').onclick = async function (e){
    e.preventDefault();
    let token = document.querySelector('.f_csrf').value;
    let country = document.getElementById('countryForm').value;
    let city = document.getElementById('cityForm').value;
    let countryFormSelect = document.getElementById('countryForm');
    let  code = countryFormSelect.options[countryFormSelect.selectedIndex].getAttribute('data-code');
    let tempFromOpenWeatherMapApi = 0;
    let weatherBitApi = 0;
    let averageTemp = 0;
    await fetch('https://api.openweathermap.org/data/2.5/weather?q=' + city +
        ',' + code +'&APPID=3917cdc8260ca221f0c56d5df2110b2b&units=metric')
        .then(val=>val.json())
        .then(val=>{
            tempFromOpenWeatherMapApi = val.main.temp;
        });


    await fetch('https://api.weatherbit.io/v2.0/current?&city=' + city +  '&country=' + code + '&key=a156cdd296424b208b393fbb785d0e96&include=minutely')
        .then(val=>val.json())
        .then(val=>{
            weatherBitApi = val.data[0].temp;
        });

    averageTemp = (tempFromOpenWeatherMapApi + weatherBitApi) / 2 ;

    Swal.fire({
        icon: 'success',
        title: 'Average temp',
        text: averageTemp,
    })

    fetch('insert-result', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            'country' : country ,
            'state' : city ,
            'temp' : averageTemp ,
        })
    })
}
