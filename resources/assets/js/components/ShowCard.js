import React, { Component } from 'react';

/* Stateless component or pure component
 * { showList } syntax is the object destructing
 */
const ShowCard = ({show}) => {

    if(!show) {
        return(<div>  show Doesnt exist </div>);
    }

    //Else, display the showList data
    {/*<div> {show.id}, {show.name} </div>*/}
    return <div>
        <div className="tvshow-wrap">
            <div className="tvshow-date-2">{show.readableAirDate}</div>
            <div className="tvshow-card">
                <div className="block-container">
                    <div className="tvshow-cover">
                        <img src={show.posterPath}/>
                    </div>
                    <div className="tvshow-info">
                        <div className="tvshow-title">
                            {show.name}
                            <span>(2018)</span>
                        </div>
                        <div className="tvshow-overview"> {show.overview} </div>
                        <div className="tvshow-other"> [more info] </div>
                    </div>
                    <a href="#" className="button-follow">Follow</a>
                </div>
            </div>
        </div>
    </div>
}

export default ShowCard ;
