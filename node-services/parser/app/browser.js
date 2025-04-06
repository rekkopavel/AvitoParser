const puppeteer = require('puppeteer');

async function startBrowser(){
    let browser;
    try {
        console.error("Opening the browser......");
        browser = await puppeteer.launch({
            headless: true,
            args: ["--disable-setuid-sandbox"],
            'ignoreHTTPSErrors': true
        });
    } catch (err) {
        console.error("Could not create a browser instance => : ", err);
    }
    return browser;
}

module.exports = {
    startBrowser
};
