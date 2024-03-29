import React, {useEffect, useState, useRef} from 'react';
import ReactDOM from 'react-dom/client';
import axios from "axios";
import RouteFields from "./RouteFields";

export default function FormGenerator() {

    const [dataType, setDataType] = useState({status: 1});
    const [clickCount, setClickCount] = useState(0);
    const [click, setClick] = useState([{id: clickCount, name: '', type: 'text'}]);
    const [routeField, setRouteField] = useState({});
    const deleteByValue = value => {
        setClick(oldValues => {
            return oldValues.filter(click => click.id !== value)
        })
    }
    const [clickOptionCount, setClickOptionCount] = useState(0);
    const [clickOption, setClickOption] = useState([clickOptionCount]);
    const deleteOptionValue = value => {
        setClickOption(oldValues => {
            return number.static_option.filter(clickOption => clickOption !== value)
        })
        // number.static_option.filter(clickOption => clickOption !== value)
    }
    const [baseURL, setBaseURL] = useState();
    const [currentURL, setCurrentURL] = useState();
    const [action, setAction] = useState();
    const [toDo, setToDo] = useState();
    const typingTimeoutRef = useRef(null);

    const loadPageData = () => {
        setBaseURL(document.getElementById('base_url').value);
        setCurrentURL(document.getElementById('current_url').value);
        setAction(document.getElementById('action_url').value);
        setToDo(document.getElementById('to_do').value);
        if (document.getElementById('to_do').value === "Update") {
            axios.get(document.getElementById('current_url').value)
                .then((response) => response)
                .then((data) => {
                    setDataType(data.data.data)
                    setClick(JSON.parse(data.data.data.field))
                    setRouteField(JSON.parse(data.data.data.route))
                    if(JSON.parse(data.data.data.field).length > 0) {
                        setClickCount(JSON.parse(data.data.data.field).length - 1);
                    }
                });
        }
    }
    const [dynamicOptions, setDynamicOptions] = useState();
    const loadAllActiveTypes = () => {
        axios.post(document.getElementById('type_list').value)
            .then((response) => response)
            .then((data) => {
                setDynamicOptions(data.data.data)
            });
    }
    useEffect(() => {
        loadPageData();
        loadAllActiveTypes();
    }, [])

    const slugChecking = (name, slug) => {
        axios.post(document.getElementById('slug_check').value, {
            name: name,
            slug: slug,
            id: dataType.id
        }).then((response) => response)
            .then((data) => {
                setDataType({...dataType, name: name, slug: data.data.slug})
            });
    }

    const handleChange = (id, updatedItem) => {
        setClick(click.map((item) => (item.id === id ? updatedItem : item)))
    }

    const handleDataInputChange = (event) => {
        const {name, value} = event.target
        if (name === 'name') {

            // setDataType({...dataType, [name]: value})
            if (3 <= value.length) {
                slugChecking(value, value.trim().toLowerCase().replace(/ /g, '-')
                    .replace(/[^\w-]+/g, ''));
            } else {
                setDataType({
                    ...dataType, name: value, slug: value.trim().toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
                })
            }

        } else if (name === 'iconFull') {
            let start = Number(1) + value.indexOf('"');
            let end = value.lastIndexOf('"') - Number(start);
            if (start && end) {
                setDataType({...dataType, icon: value.substr(start, end), [name]: value})
            } else {
                setDataType({...dataType, [name]: ''})
            }

        } else {
            setDataType({...dataType, [name]: value})
        }
    }

    const onSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        if(toDo === "Update") {
            formData.append("_method", "PUT");
        }
        formData.append("type", JSON.stringify(dataType));
        formData.append("fields", JSON.stringify(click));
        formData.append("route", JSON.stringify(routeField));
        axios.post(`${action}`, formData)
            .then((response) => response)
            .then((data) => {
                window.location.assign(`${baseURL}/backend/types`)
                // console.log(data.data)
                // setDataType({...dataType, slug: data.data.slug})
            });
    }

    return (
        <>
            <fieldset>
                <legend>Core</legend>
                <div className="form-group mb-3">
                    <label htmlFor="name">Name</label>
                    <input id="name" className="form-control" name="name" type="text" placeholder=""
                           required="required" defaultValue={dataType.name} onChange={handleDataInputChange}/>

                </div>
                <div className="form-group mb-3">
                    <label htmlFor="name">Slug</label>
                    <input id="slug" className="form-control" name="slug" type="text" placeholder=""
                           required="required" defaultValue={dataType.slug} onChange={handleDataInputChange} readOnly/>
                </div>
                <div className="form-group mb-3">
                    <div className="row">
                        <div className="col-6">
                            <label htmlFor="name">Icon Class</label>
                            <div className="input-group">
                                {dataType.icon && dataType.icon !== '' ? (
                                    <span className="input-group-text"><i
                                        className={`${dataType.icon}`}></i></span>) : (<></>)}

                                {/*<input type="text" className="form-control" placeholder="Username" aria-label="Username"*/}
                                {/*       aria-describedby="basic-addon1"/>*/}
                                <input id="icon" className="form-control" name="icon" type="text" placeholder="Icon"
                                       required="required" value={dataType.icon}
                                       onChange={handleDataInputChange}
                                />
                            </div>
                        </div>
                        <div className="col-6">
                            <label htmlFor="name">Icon Past Here</label>

                            {/*<input type="text" className="form-control" placeholder="Username" aria-label="Username"*/}
                            {/*       aria-describedby="basic-addon1"/>*/}
                            <input id="icon" className="form-control" name="iconFull" type="text" placeholder="Icon"
                                   required="required" defaultValue={dataType.iconFull}
                                   onChange={handleDataInputChange}
                            />
                        </div>

                    </div>
                    <div><a href="https://fontawesome.com/v6/search?o=r&m=free" target="_blank">Get Icon</a></div>
                </div>
                <div className="form-group mb-3">
                    <label htmlFor="status">Status</label>
                    <select id="status" className="form-control" name="status" defaultValue={dataType.status} value={dataType.status}
                            onChange={handleDataInputChange}>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend style={{paddingLeft: 0}}>
                    <button type="button" className="btn btn-main  btn-sm" onClick={() => {
                        setClick(oldArray => [...oldArray, {id: clickCount + 1, name: '', type: 'text'}])
                        setClickCount(clickCount + 1);
                    }}>
                        <i className="fa fa-plus"></i>
                    </button>
                    &nbsp;
                    Fields Setup
                </legend>
                <div className="row">
                    {
                        click.map((number, index) =>
                            <div key={index} className="col-12">
                                <div className="accordion" id={`field-${number.id}`}>
                                    <div className="accordion-item">
                                        <h2 className="accordion-header field-header" id={`form-field-${number.id}`}>
                                            <button className="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target={`#form-field-button-${number.id}`}
                                                    aria-expanded="false"
                                                    aria-controls={`form-field-button-${number.id}`}>

                                                    <div className="col-md-4">
                                                        <span className="name">{number.labelText}</span>
                                                        <div><small><span className="name">{number.name}</span></small></div>
                                                    </div>
                                                    <div className="col-md-4">
                                                        <span className="type">{number.type}</span>
                                                    </div>

                                            </button>
                                            <legend className="close--button"
                                                    onClick={() => deleteByValue(number.id)}><i
                                                className="fa-solid fa-xmark"></i></legend>
                                        </h2>
                                        <div id={`form-field-button-${number.id}`}
                                             className="accordion-collapse collapse"
                                             aria-labelledby={`form-field-${number.id}`}
                                             data-bs-parent={`#field-${number.id}`}>
                                            <div className="accordion-body">
                                                <fieldset>
                                                    <div className="main-field">
                                                        <div className="field-closer">
                                                            <div>
                                                                <legend className="close--button"
                                                                        onClick={() => deleteByValue(number.id)}><i
                                                                    className="fa-solid fa-xmark"></i></legend>
                                                            </div>
                                                        </div>
                                                        <div className="field-part">

                                                            <div className="form-group mb-3">
                                                                <label htmlFor="status">Name *</label>
                                                                <input className="form-control"
                                                                       name={`field[${number.id}][name]`}
                                                                       value={number.name} onChange={(event) => {
                                                                    const {name, value} = event.target
                                                                    number.name = value.trim().toLowerCase().replace('-', '_').replace(/ /g, '_').replace(/[^\w-]+/g, '');
                                                                    handleChange(number.id, number)
                                                                }}/>
                                                            </div>


                                                            <div className="form-group mb-3">
                                                                <label htmlFor="status">Type *</label>
                                                                <select className="form-control"
                                                                        name={`field[${number.id}][type]`}
                                                                        defaultValue={number.type}
                                                                        onChange={(event) => {
                                                                            const {name, value} = event.target
                                                                            number.type = value;
                                                                            if(value === "select") {
                                                                                number.static = "static";
                                                                                number.static_option = [];
                                                                                number.static_option[0] = {key: "", value: ""};
                                                                                // number.hasOwnProperty("static_option")
                                                                            }
                                                                            handleChange(number.id, number)
                                                                            // setClickOptionCount(0);
                                                                            // setClickOption([clickOptionCount]);
                                                                        }}>
                                                                    <option value="text">Text</option>
                                                                    <option value="date">Date</option>
                                                                    <option value="email">Email</option>
                                                                    <option value="file">File</option>
                                                                    <option value="select">Select</option>
                                                                    <option value="checkbox">Checkbox</option>
                                                                    <option value="radio">Radio</option>
                                                                    <option value="textarea">Textarea</option>
                                                                </select>
                                                            </div>


                                                            {number.type === 'select' || number.type === 'checkbox' || number.type === 'radio' ?
                                                                (
                                                                    <div className="form-group mb-3">
                                                                        {number.type === 'select' ? (<>
                                                                        <label htmlFor="status">Static/Dynamic </label>
                                                                        <select className="form-control mb-3"
                                                                                name={`field[${number.id}][static]`}
                                                                                defaultValue={number.static}
                                                                                value={number.static}
                                                                                onChange={(event) => {
                                                                                    const {name, value} = event.target
                                                                                    number.static = value;
                                                                                    // if(value === "static") {
                                                                                    //     console.log(number.hasOwnProperty("static_option"))
                                                                                    // }
                                                                                    handleChange(number.id, number)
                                                                                }}>
                                                                            <option value="static">Static Value</option>
                                                                            <option value="dynamic">Dynamic Value</option>
                                                                        </select>
                                                                        </>) : (<></>)}

                                                                        {number.static != "dynamic" ? (<>
                                                                            <label htmlFor="status">Option</label>
                                                                            <div className="input-group">
                                                                                <input className="form-control"
                                                                                       defaultValue="Key"
                                                                                       readOnly/>
                                                                                <input className="form-control"
                                                                                       defaultValue="Value"
                                                                                       readOnly/>
                                                                                <span className="input-group-text"
                                                                                      onClick={() => {
                                                                                          if(number.hasOwnProperty("static_option")) {
                                                                                              let le = number.static_option.length;
                                                                                              number.static_option[le] = {key: le, value: ""};
                                                                                              handleChange(number.id, number)
                                                                                          }
                                                                                          // setClickOption(oldArray => [...oldArray, clickOptionCount + 1])
                                                                                          // setClickOptionCount(clickOptionCount + 1);
                                                                                      }}><i className="fa fa-plus"></i></span>
                                                                            </div>
                                                                            {/*{console.log(number)}*/}
                                                                            {/*{Object.entries(number.static_option).map((option, optionIndex) => console.log(option))}*/}
                                                                            {
                                                                                // <>{console.log("number.static_option")}</>
                                                                                // <>{console.log(number.static_option)}</>
                                                                                // clickOption.map((option, optionIndex) =>
                                                                                // clickOption.map((option, optionIndex) =>
                                                                                // Object.entries(number.static_option).map((option, optionIndex) =>
                                                                                number.static_option.map((option, optionIndex) =>
                                                                                    <div key={option['key']}
                                                                                         className="input-group">
                                                                                        <input className="form-control"
                                                                                               defaultValue={option['key']}
                                                                                               onChange={(event) => {

                                                                                                   if (typingTimeoutRef.current) {
                                                                                                       clearTimeout(typingTimeoutRef.current);
                                                                                                   }
                                                                                                   typingTimeoutRef.current = setTimeout(function () {
                                                                                                       const {name, value} = event.target
                                                                                                       number.static_option[optionIndex] = {key: value, value: option['value']};
                                                                                                       handleChange(number.id, number)
                                                                                                   }, 500);

                                                                                               }}
                                                                                               name={`field[${number.id}][options][${option}][key]`}/>
                                                                                        <input className="form-control"
                                                                                               defaultValue={option['value']}
                                                                                               onChange={(event) => {
                                                                                                   const {name, value} = event.target
                                                                                                   number.static_option[optionIndex] = {key: option['key'], value: value};
                                                                                                   handleChange(number.id, number)
                                                                                               }}
                                                                                               name={`field[${number.id}][options][${option}][value]`}/>
                                                                                        <span
                                                                                            className="input-group-text"
                                                                                            onClick={() => {
                                                                                                // deleteOptionValue(option)
                                                                                                number.static_option = number.static_option.filter(clickOption => clickOption !== option)
                                                                                                handleChange(number.id, number)
                                                                                            }}><i
                                                                                            className="fa-solid fa-xmark"></i>&nbsp;</span>
                                                                                        {console.log(option)}
                                                                                    </div>
                                                                                )
                                                                            }
                                                                        </>) : (<>
                                                                            <label htmlFor="status">Dynamic Option</label>
                                                                            <select className="form-control"
                                                                                    name={`field[${number.id}][dynamic_option]`}
                                                                                    defaultValue={number.dynamic_option}
                                                                                    value={number.dynamic_option}
                                                                                    onChange={(event) => {
                                                                                        const {name, value} = event.target
                                                                                        number.dynamic_option = value;
                                                                                        handleChange(number.id, number)
                                                                                    }}>
                                                                                {Object.entries(dynamicOptions).map((option, optionIndex) => <option key={optionIndex} value={option[0]}>{option[1]}</option>)}
                                                                            </select>
                                                                        </>)}
                                                                </div>)
                                                                : (<></>)
                                                            }
                                                            {
                                                                number.type === 'textarea' ? (
                                                                    <div className="form-group mb-3">
                                                                        <label htmlFor="status">Row</label>
                                                                        <input className="form-control"
                                                                               name={`field[${number.id}][row]`}
                                                                               defaultValue={number.row}
                                                                               onChange={(event) => {
                                                                                   const {name, value} = event.target
                                                                                   number.row = value;
                                                                                   handleChange(number.id, number)
                                                                               }}/>
                                                                    </div>
                                                                ) : (
                                                                    <></>
                                                                )
                                                            }
                                                            {number.type === 'select' || number.type === 'checkbox' || number.type === 'file' ? (
                                                                <div className="form-group mb-3">
                                                                    <label htmlFor="status">Multiple</label>
                                                                    <select className="form-control"
                                                                            name={`field[${number.id}][multiple]`}
                                                                            defaultValue={number.multiple}
                                                                            onChange={(event) => {
                                                                                const {name, value} = event.target
                                                                                number.multiple = value;
                                                                                handleChange(number.id, number)
                                                                            }}>
                                                                        <option value="false">No</option>
                                                                        <option value="true">Yes</option>
                                                                    </select>
                                                                </div>
                                                            ) : (<></>)}


                                                            <div className="accordion" id={`form-${number.id}`}>
                                                                <div className="accordion-item">
                                                                    <h2 className="accordion-header"
                                                                        id={`form-additional-${number.id}`}>
                                                                        <button className="accordion-button collapsed"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target={`#form-additional-button-${number.id}`}
                                                                                aria-expanded="false"
                                                                                aria-controls={`form-additional-button-${number.id}`}>
                                                                            Additionals
                                                                        </button>
                                                                    </h2>
                                                                    <div id={`form-additional-button-${number.id}`}
                                                                         className="accordion-collapse collapse"
                                                                         aria-labelledby={`form-additional-${number.id}`}
                                                                         data-bs-parent={`#form-${number.id}`}>
                                                                        <div className="accordion-body">

                                                                            <fieldset>
                                                                                <legend>Self</legend>
                                                                                <div className="form-group mb-3">
                                                                                    <label
                                                                                        htmlFor="status">Placeholder</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][placeholder]`}
                                                                                           defaultValue={number.placeholder}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.placeholder = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>

                                                                                <div className="form-group mb-3">
                                                                                    <label htmlFor="status">ID</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][ID]`}
                                                                                           defaultValue={number.ID}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.ID = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>

                                                                                <div className="form-group mb-3">
                                                                                    <label
                                                                                        htmlFor="status">Class <small>(separated
                                                                                        with
                                                                                        space)</small></label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][class]`}
                                                                                           defaultValue={number.class}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.class = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>
                                                                            </fieldset>
                                                                            <fieldset>
                                                                                <legend>Label</legend>
                                                                                <div className="form-group mb-3">
                                                                                    <label htmlFor="status">Text</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][label][text]`}
                                                                                           defaultValue={number.labelText}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.labelText = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>
                                                                                <div className="form-group mb-3">
                                                                                    <label
                                                                                        htmlFor="status">Class</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][label][class]`}
                                                                                           defaultValue={number.labelClass}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.labelClass = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>
                                                                            </fieldset>

                                                                            <fieldset>
                                                                                <legend>Parent</legend>
                                                                                <div className="form-group mb-3">
                                                                                    <label htmlFor="status">ID</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][parent][id]`}
                                                                                           defaultValue={number.parentID}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.parentID = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>
                                                                                <div className="form-group mb-3">
                                                                                    <label
                                                                                        htmlFor="status">Class</label>
                                                                                    <input className="form-control"
                                                                                           name={`field[${number.id}][parent][class]`}
                                                                                           defaultValue={number.parentClass}
                                                                                           onChange={(event) => {
                                                                                               const {
                                                                                                   name,
                                                                                                   value
                                                                                               } = event.target
                                                                                               number.parentClass = value;
                                                                                               handleChange(number.id, number)
                                                                                           }}/>
                                                                                </div>
                                                                            </fieldset>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )
                    }
                </div>
            </fieldset>

            <RouteFields click={click} dataType={dataType} routeField={routeField} setRouteField={setRouteField}/>

            <div className="text-left">
                {/*<input className="btn btn-main" type="button" value="Submit" onClick={onSubmit}/>*/}
                <button className="btn btn-main" type="button" onClick={onSubmit}>Submit</button>
            </div>

        </>
    );
}

if (document.getElementById('type-form-generator')) {
    const root = ReactDOM.createRoot(document.getElementById('type-form-generator'));
    root.render(<FormGenerator/>);
}
