const express = require('express');
const app = express();
const PORT = 3000;

const axios = require('axios');
const cheerio = require('cheerio')

// Function to fetch and scrape the website
async function getCharge(month, year) {
    // parse month into number
    let date = new Date(`${month} 1, ${year}`);
    let now = new Date();
    if (now.getMonth() === date.getMonth() && now.getFullYear() === year) {
        // get the previous month
        date.setMonth(date.getMonth() - 1);
    }

    try {

        // Fetch HTML content of the website
        month = date.toLocaleString('default', { month: 'long' }).toLowerCase();
        let url = `https://company.meralco.com.ph/news-and-advisories/${month}-${year}-rates-updates${month === 'april' ? '-0' : ''}`;

        const response = await axios.get(url);
        const html = response.data;

        // Load HTML content into Cheerio
        const $ = cheerio.load(html);

        // Find specific word in the HTML content
        const firstPInDiv = $('div.node-field.body').text();
        const findIn = 'overall rate for a typical household';

        // Get the number between the two specific words, use regex
        const charge = firstPInDiv.substring(firstPInDiv.indexOf(findIn) + findIn.length).split('P')[1].substring(0, 7);

        // Output the specific word
        console.log('Charge:', charge);

        // convert to float
        return parseFloat(charge);

    } catch (error) {
        return 0;
    }
}

app.get('/charge', async (req, res) => {
    let month = req.query.month;
    let year = req.query.year;
    let charge = await getCharge(month, year);
    res.send({ rate: charge });
});




// Function to fetch and scrape the website
async function getCharge(month, year) {
    // parse month into number
    let date = new Date(`${month} 1, ${year}`);
    let now = new Date();
    if (now.getMonth() === date.getMonth() && now.getFullYear() === year) {
        // get the previous month
        date.setMonth(date.getMonth() - 1);
    }

    try {

        // Fetch HTML content of the website
        month = date.toLocaleString('default', { month: 'long' }).toLowerCase();
        let url = `https://company.meralco.com.ph/news-and-advisories/${month}-${year}-rates-updates${month === 'april' ? '-0' : ''}`;

        const response = await axios.get(url);
        const html = response.data;

        // Load HTML content into Cheerio
        const $ = cheerio.load(html);

        // Find specific word in the HTML content
        const firstPInDiv = $('div.node-field.body').text();
        const findIn = 'overall rate for a typical household';

        // Get the number between the two specific words, use regex
        const charge = firstPInDiv.substring(firstPInDiv.indexOf(findIn) + findIn.length).split('P')[1].substring(0, 7);

        // Output the specific word
        console.log('Charge:', charge, month, year);

        // convert to float
        return parseFloat(charge);

    } catch (error) {
        return 0;
    }
}

app.use(express.static('./'));

app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});


app.listen(PORT, () => console.log(`Server listening on port: http://localhost:${PORT}`));