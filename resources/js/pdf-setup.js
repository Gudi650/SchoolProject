// Expose pdf.js as a global using Vite bundling
// Use ESM build of pdf.js
import * as pdfjsLib from 'pdfjs-dist';
// Bundle the worker via Vite using ?worker so it becomes a real Web Worker
import PdfWorker from 'pdfjs-dist/build/pdf.worker.mjs?worker';

// In dev, the app runs on 127.0.0.1:8000 and Vite on 127.0.0.1:5173.
// Creating a worker from a different origin can throw SecurityError.
// Avoid that by disabling the worker in development; use the worker in production.
if (import.meta.env.DEV) {
	// Disable worker for development - we'll pass ArrayBuffer data directly to bypass worker code
	pdfjsLib.GlobalWorkerOptions.disableWorker = true;
	console.log('PDF.js: Worker disabled for development');
} else {
	// Use module worker in production where assets are served same-origin
	pdfjsLib.GlobalWorkerOptions.workerPort = new PdfWorker({ type: 'module' });
	console.log('PDF.js: Using bundled worker for production');
}

window.pdfjsLib = pdfjsLib;
console.log('pdf.js initialized via Vite (DEV:', import.meta.env.DEV, ')');
