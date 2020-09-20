// add and edit
'use strict';

window.onload = function() {
    document.querySelector('#btn-view').onclick = function() {
        let input = document.querySelector('#key').value;
        if(input === '') {
            out_msg('error', 'ключь не задан');
            setTimeout(function cb() {
                location.reload()
            }, 1000)
            return false;
        }
         clear_msg()

        let out_data = {
            inp: input,
            desc: 'out',
            state: this.id,
        }

         let frm = document.querySelector('#frm-conf');
         let url = frm.action;
         let method = frm.method;
         let body = new FormData(frm);
         body.append("json", JSON.stringify(out_data/*, null, 4*/));

         let fetchData = {
           method: method,
           body: body,
           cache: 'no-cache',
       }

       requestFetch(url, fetchData);
    }

//--- обработка передачи select.option в input
    document.querySelector('#select').onclick = function() {
        document.querySelector('#key').value = this.value;
    }

//--- POST отправка данных формы на сервер
    async function requestFetch(url, fetchdata) {
        return await fetch(url, fetchdata)
        .then(status)
        .then(json)  
        .then(function (data) {
            if(data.path != '') {
                        // вызовем какую нить функцию в js
                        console.log('Request path', data.path);
                    }

                    out_msg(data.status, data.status + ': ' + data.message)

                    let pause = 0
                    if(data.status === 'error' || data.status === 'WARNING')
                        pause = 1000

                    setTimeout(function cb() {
                        location.reload()
                    }, pause)
                })
        .catch(function (error) {
            console.log('Request failed', error);
            // setTimeout(function cb() {
            //     location.reload()
            // }, 3)
        });
    }
    function status(response) {
        if(response.status >= 200 && response.status < 300) {
            return Promise.resolve(response)  
        } else {  
            return Promise.reject(new Error(response.statusText))
        }  
    }
    function json(response) {
        return response.json()  
    }

//--- message
    // очистка поля сообщений по клику на нем
    document.querySelector('#errorMsg').onclick = function() {
        clear_msg()
    }

    function out_msg(status, msg) {
        let elem = document.querySelector('#errorMsg');
        elem.innerHTML = '<label style="height: 8px;" id="close-msg">' + msg + '</label>';
        if(status === 'error')
            elem.style.background = '#FF9188FF';
        else if(status === 'WARNING')
            elem.style.background = '#88FCFFFF';
        else
            elem.style.background = '#A4FF88FF';
    }

    function clear_msg() {
        let elem = document.querySelector('#errorMsg');
        elem.innerHTML = '<label></label>';
        elem.style.background = '#FFFFFF';
    }
}
