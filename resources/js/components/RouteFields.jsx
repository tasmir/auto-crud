import React from "react";

export default function RouteFields(props) {
    return (<>
        <fieldset>
            <legend>Route Fields</legend>
            <div className="form-group mb-3">
                <div className="input-group">
                    <span className="input-group-text">Route /</span>
                    <input className="form-control" type="text" value={`${props.dataType.slug ?? ''}/`} readOnly/>
                </div>
                <label htmlFor="status">Show Table</label>
                <select className="form-control" name={`route[index][]`} value={props.routeField.index} multiple onChange={(e) => {
                    let value = Array.from(e.target.selectedOptions, option => option.value);
                    props.setRouteField({...props.routeField, index: value })
                }}>
                    {props.click.map((field, index) => (
                        <option key={index} value={field.name} >{field.name}</option>
                    ))}

                    {/*<option value="true">Yes</option>*/}
                </select>
            </div>
        </fieldset>
    </>);
}
