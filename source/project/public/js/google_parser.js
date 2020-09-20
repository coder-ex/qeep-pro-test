google_play_store();

function google_play_store (){
    let argv = require('minimist')(process.argv.slice(2));

    let gplay = require('google-play-scraper');
    gplay.search({
        term: argv['keyword'],
        num: argv['depth'],
        fullDetail: true,
    }).then(function(value) {
        console.log(JSON.stringify(value));
    }, function(value) {
        console.log(JSON.stringify(value));
    });
}


