const fs = require('fs');
const filepath = 'reviews\Reviews.txt';

function currentTime(){
    const now = new Date();
    let h = now.getHours();
    let m = now.getMinutes();
    let s = now.getSeconds();
    let time = h + "," + m + "," + s;
    if(time === "22,49,00"){
        fs.unlink(filepath, (err) => {
            if (err){
                console.error('No file of the sort');
                return;
            }
            console.log('file deleted');
        });
    }
}

