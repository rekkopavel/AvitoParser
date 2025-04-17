const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch({
        executablePath: '/usr/bin/google-chrome',
        headless: 'new',
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',

        ],
        dumpio: true
    });

    try {
        const page = await browser.newPage();
        const argv = require('minimist')(process.argv.slice(2));
        // Включаем подробное логирование запросов
        page.on('request', req => console.error(`Request: ${req.url()}`));
        page.on('response', res => console.error(`Response: ${res.status()} ${res.url()}`));

        console.error('Navigating to page...');
        await page.goto(argv.url, {
            waitUntil: 'networkidle2', // Ждём завершения сетевых запросов
            timeout: 120000
        });

        // Явное ожидание заголовка
        const title = await page.evaluate(() => document.title);

        console.error('Page title:', title || 'NULL (empty title)');

        // Дополнительная проверка контента
        const content = await page.content();

        console.log(content);
        if (content.length < 100) {
            console.error('Content too short, likely blocked');
        }

    } finally {
        await browser.close();
    }


})();
