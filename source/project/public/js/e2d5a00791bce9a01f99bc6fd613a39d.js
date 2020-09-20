// add and edit
'use strict';

window.onload = function() {
    document.querySelector('#btn-edit').onclick = function() {
        let input = document.querySelector('#class').value;
        if(input === '') {
            out_msg('error', 'ключь не задан');
            setTimeout(function cb() {
                location.reload()
            }, 1000)
            return false;
        }

        let name = document.querySelector('input[name=add-depth]').value
        let t = parseInt(name, 10);
        if(isNaN(t)) {
            out_msg('error','должно быть число 5 - 250');
            setTimeout(function cb() {
                location.reload()
            }, 1000)
            return false;
        } else if(t < 5 || t > 250) {
             out_msg('error','диапазон значений 5 - 250');
             setTimeout(function cb() {
                 location.reload()
             }, 1000)
             return false;
         }

        let cb_active = document.querySelector('input[name=active]').checked;

         clear_msg()

        let out_data = {
            input: input,
            name: name,
            cb_active: cb_active,
            desc: 'edit',
            state: this.id,
        }

         let frm = document.querySelector('#frm-edit');
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

    document.querySelector('#btn-delete').onclick = function() {
        let input = document.querySelector('#class').value;
        let name = document.querySelector('input[name=add-depth]').value
        if(input === '') {
            out_msg('error', 'для удаления нет значений');
            setTimeout(function cb() {
                location.reload()
            }, 1000)
            return false;
        }
        clear_msg()

        let out_data = {
            input: input,
            name: name,
            desc: 'delete',
            state: this.id,
        }

        let frm = document.querySelector('#frm-edit');
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

    document.querySelector('#btn-updb').onclick = function() {
        clear_msg()

        let out_data = {
            desc: 'update',
        }

        let frm = document.querySelector('#frm-edit');
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
        document.querySelector('#class').value = this.value;
        let val = this.options;
        for(let i = 0; i < val.length; i++) {
            if(val[i].value === this.value) {
                document.querySelector('#name').value = val[i + 1].value;
                document.querySelector('#activeCheck').checked = val[i + 2].value;
                break;
            } else continue;
        }
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
                    if(data.status === 'error' || data.status === 'warning')
                        pause = 3000

                    setTimeout(function cb() {
                        location.reload()
                    }, pause)
                })
        .catch(function (error) {
            console.log('Request failed', error);
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
        else if(status === 'warning')
            elem.style.background = '#ffce2b';
        else
            elem.style.background = '#A4FF88FF';
    }

    function clear_msg() {
        let elem = document.querySelector('#errorMsg');
        elem.innerHTML = '<label></label>';
        elem.style.background = '#FFFFFF';
    }
}
