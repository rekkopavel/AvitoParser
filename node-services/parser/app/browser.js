const puppeteer = require('puppeteer');

async function startBrowser(){
    let browser;
    try {
        const browser = await puppeteer.launch({
            executablePath: '/usr/bin/google-chrome',
            headless: 'new',
            args: [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                // '--single-process', // Убрали из-за ошибки V8 Proxy

            ],
            dumpio: true
        });
    } catch (err) {
        console.error("Could not create a browser instance => : ", err);
    }
    console.error("Opening the browser.dfgdfgdgd.....");
    return browser;
}

module.exports = {
    startBrowser
};
