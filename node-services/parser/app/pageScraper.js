const scraperObject = {




    async scraper(browser) {
        const argv = require('minimist')(process.argv.slice(2));
        let page = await browser.newPage();
        console.error(`Navigating to ${argv["url"]}...`);
        await page.goto(argv.url);
        const contentSelector = 'body';
        await page.waitForSelector(contentSelector, {timeout: 0});
        await page.waitForSelector('body');
        const pageContent = await page.$eval(
            contentSelector, contentSelector => contentSelector.innerHTML
        );

        console.log(pageContent);
    }
}

module.exports = scraperObject;
