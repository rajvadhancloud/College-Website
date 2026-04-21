const puppeteer = require('puppeteer');
const path = require('path');

(async () => {
  const htmlFile = path.resolve(__dirname, 'hubspot-deduplication-guide.html');
  const outputPdf = path.resolve(__dirname, 'HubSpot-Deduplication-Guide.pdf');

  console.log('Launching browser...');
  const browser = await puppeteer.launch({
    executablePath: '/usr/local/bin/google-chrome',
    args: [
      '--no-sandbox',
      '--disable-setuid-sandbox',
      '--disable-dev-shm-usage',
      '--font-render-hinting=none',
      '--force-color-profile=srgb'
    ]
  });

  const page = await browser.newPage();

  // A4 at 96 DPI = 794×1123 px; use 2x device scale for sharp, crisp text
  await page.setViewport({
    width: 1240,
    height: 1754,
    deviceScaleFactor: 2
  });

  console.log('Loading HTML file...');
  await page.goto(`file://${htmlFile}`, {
    waitUntil: ['networkidle0', 'domcontentloaded'],
    timeout: 30000
  });

  // Allow web fonts and animations to fully render
  await new Promise(r => setTimeout(r, 1500));

  console.log('Generating PDF...');
  await page.pdf({
    path: outputPdf,
    format: 'A4',
    printBackground: true,
    preferCSSPageSize: true,
    margin: { top: '0', right: '0', bottom: '0', left: '0' },
    displayHeaderFooter: false
  });

  await browser.close();
  console.log(`PDF saved to: ${outputPdf}`);
})();
