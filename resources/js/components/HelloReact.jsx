import React from 'react';
import ReactDOM from 'react-dom/client';

export default function HelloReact() {
    return (
        <h1 className="text-center bg-primary">Hello React!</h1>
    );
}

if (document.getElementById('hello-react')) {
    const root = ReactDOM.createRoot(document.getElementById('hello-react'));
    root.render(<HelloReact />);
}
