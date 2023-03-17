import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";


export default function SideMenuOfTypes() {
    const [baseURL, setBaseURL] = useState(document.getElementById('base_url').value);
    const [currentURL, setCurrentURL] = useState(document.getElementById('current_url').value);
    const [types, setTypes] = useState([]);
    useEffect(() => {
        loadPageData();
    }, []);
    const loadPageData = () => {
        axios.get(document.getElementById('base_url').value + '/backend/types')
            .then((response) => response)
            .then((data) => {
                setTypes(data.data.data)
            });


    }


    // console.log(types)
    return (
        <>
            {types ? (
                <>
                    <div className="sb-sidenav-menu-heading">All Types</div>
                    {types.map((field, index) => (
                        <a key={field.id} className="nav-link" href={`${baseURL}/backend/${field.slug}`}>
                        <div className="sb-nav-link-icon"><i className={field.icon}></i></div>
                    {field.name}
                        </a>
                    ))}


                </>
            ) : (<></>)
            }
        </>
    );
}

if (document.getElementById('side-menu-of-types')) {
    const root = ReactDOM.createRoot(document.getElementById('side-menu-of-types'));
    root.render(<SideMenuOfTypes/>);
}
