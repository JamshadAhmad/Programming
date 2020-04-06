//Question https://javaconceptoftheday.com/how-to-create-spiral-of-numbers-matrix-in-java/

//Solution in JS

let input = 5;

let arr = [];

//initialize array with zeros
for (let i = 0; i < input ; i++) {
    arr[i] = [];
    for (let j = 0 ; j < input ; j++) {
        arr[i][j] = 0;
    }
}

let i=j=0;
let direction = 'r';
let fillNumber = 1; //lets start with number 1

while (fillNumber <= input*input) {
    arr[i][j] = fillNumber++;
    if (direction === 'r') {
        if (j+1 < input && arr[i][j+1] === 0) {
            j++;
        } else if (j+1 >= input || arr[i][j+1] !==0) {
            i++;
            direction = 'd';
        }
    } else if (direction === 'd') {
        if (i+1 < input && arr[i+1][j] === 0) {
            i++;
        } else if (i+1 >= input || arr[i+1][j] !==0) {
            j--;
            direction = 'l';
        }
    } else if (direction === 'l') {
        if (j-1 >= 0 && arr[i][j-1] === 0) {
            j--;
        } else if (j-1 < 0 || arr[i][j-1] !==0) {
            i--;
            direction = 'u';
        }
    } else if (direction === 'u') {
        if (i-1 >= 0 && arr[i-1][j] === 0) {
            i--;
        } else if (i-1 < 0 || arr[i-1][j] !==0) {
            j++;
            direction = 'r';
        }
    }
}

printArray(arr);

//Helper functions
function printArray(arr) {
    for (let i = 0; i < input ; i++) {
        console.log(arr[i]);
    }
}