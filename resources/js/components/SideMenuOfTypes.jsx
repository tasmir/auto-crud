import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";


export default function SideMenuOfTypes() {
    const [baseURL, setBaseURL] = useState(document.getElementById('base_url').value);
    const [currentURL, setCurrentURL] = useState(document.getElementById('current_url').value);
    const [inMenu, setInMenu] = useState(false);
    const [types, setTypes] = useState([]);
    const [isLoaded, setIsLoaded] = useState(false)
    useEffect(() => {
        loadPageData();

    }, [isLoaded]);
    const loadPageData = () => {
        axios.get(document.getElementById('base_url').value + '/backend/types')
            .then((response) => response)
            .then((data) => {
                setTypes(data.data.data)
            }).finally(() => {inMenuCheck(); setIsLoaded(true)});


    }
    const inMenuCheck = () => {
        let spliteCurrent = currentURL.toString().split("/");
        for (let i = 0; i < types.length; i++) {
            if(spliteCurrent[4] === types[i].slug) {
                setInMenu(true)
                return;
            }
        }
    }
    const currentUrlChecker = (c_url) => {
        let spliteCurrent = currentURL.toString().split("/");
        let spliteCUrl = c_url.toString().split("/");
        if (c_url === currentURL) {
            return 'active';
        } else if (spliteCurrent.length > 5 && spliteCurrent[4] === spliteCUrl[4] && (spliteCurrent[5] === 'create' || spliteCurrent[6] === 'edit' || spliteCurrent[6] === 'show')) {
            return 'active';
        } else {
            return '';
        }
    }
    // inMenuCheck();
    // console.log(menuArray)
    return (
        <>
            {types ? (
                <>
                    <div className="sb-sidenav-menu-heading">All Types</div>
                    {/*  */}
                    <a className={`nav-link ${inMenu ? `active` : `collapsed`}`} href="#"
                       data-bs-toggle="collapse" data-bs-target="#collapseVenues"
                       aria-expanded={inMenu ? "true" : "false"}
                       aria-controls="collapseVenues">
                        <div className="sb-nav-link-icon"><i className="fa-solid fa-location-dot"></i></div>
                        Venues
                        <div className="sb-sidenav-collapse-arrow"><i className="fas fa-angle-down"></i></div>
                    </a>
                    <div className={`collapse ${inMenu ? `show` : ``}`} id="collapseVenues"
                         aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav className="sb-sidenav-menu-nested nav">

                            {types.map((field, index) => (
                                <a key={field.id}
                                   className={`nav-link ${currentUrlChecker(`${baseURL}/backend/${field.slug}`)}`}
                                   href={`${baseURL}/backend/${field.slug}`}>
                                    <div className="sb-nav-link-icon"><i className={field.icon}></i></div>
                                    {field.name}
                                </a>
                            ))}
                        </nav>
                    </div>
                    {/*{types.map((field, index) => (*/}
                    {/*    <a key={field.id} className={`nav-link ${currentUrlChecker(`${baseURL}/backend/${field.slug}`)}`} href={`${baseURL}/backend/${field.slug}`}>*/}
                    {/*    <div className="sb-nav-link-icon"><i className={field.icon}></i></div>*/}
                    {/*{field.name}*/}
                    {/*    </a>*/}
                    {/*))}*/}


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
