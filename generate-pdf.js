const puppeteer = require('puppeteer');
const path = require('path');

(async () => {
  const htmlFile = path.resolve(__dirname, 'hubspot-deduplication-guide.html');
  const outputPdf = path.resolve(__dirname, 'HubSpot-Deduplication-Guide.pdf');

  console.log('Launching browser...');
  const browser = await puppeteer.launch({
    executablePath: '/usr/local/bin/google-chrome',
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });

  const page = await browser.newPage();

  console.log('Loading HTML file...');
  await page.goto(`file://${htmlFile}`, { waitUntil: 'networkidle0' });

  console.log('Generating PDF...');
  await page.pdf({
    path: outputPdf,
    format: 'A4',
    printBackground: true,
    margin: { top: '0', right: '0', bottom: '0', left: '0' }
  });

  await browser.close();
  console.log(`✅ PDF saved to: ${outputPdf}`);
})();
