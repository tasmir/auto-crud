import React from "react";

export default function RouteFields({...props}) {
    return (<>
        <fieldset>
            <legend>Route Fields</legend>
            <div className="form-group mb-3">
                <div className="input-group">
                    <span className="input-group-text">Route /</span>
                    <input className="form-control" type="text" value={`${props.dataType.slug ?? ''}/`} readOnly/>
                </div>
                <label htmlFor="status">Show Table</label>
                <select className="form-control" name={`route[index]`} multiple>
                    {props.click.map((field, index) => (
                        <option key={index} value={field.name}>{field.name}</option>
                    ))}

                    {/*<option value="true">Yes</option>*/}
                </select>
            </div>
        </fieldset>
    </>);
}
