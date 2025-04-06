const browserObject = require('./app/browser');
const scraperController = require('./app/pageController');

//Start the browser and create a browser instance
let browserInstance = browserObject.startBrowser();


//setTimeout(process.exit(1), 60000);
// Pass the browser instance to the scraper controller
scraperController(browserInstance)
