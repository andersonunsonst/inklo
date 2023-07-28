import axios from 'axios';

const api = axios.create({
    baseURL: 'https://api.github.com/users',
    headers: {
        Authorization : `Bearer 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`
        }
});

const backend = axios.create({
    baseURL: 'http://localhost:8000'
})

const perfils = [
    'wallysonn', 
    'diego3g',
    'filipedeschamps',
    'rmanguinho',
    'andersonunsonst'
];

export {api, perfils, backend};