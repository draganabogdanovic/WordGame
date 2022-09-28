import '@testing-library/jest-dom';

Object.defineProperty(window, 'scrollTo', { value: () => {}, writable: true });
Object.defineProperty(window, 'performance', { value: { getEntriesByType: () => ([{ type: 'back_forward' }]) } });
