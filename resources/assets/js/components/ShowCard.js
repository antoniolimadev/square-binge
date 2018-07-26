import React, { Component } from 'react';

const ShowCard = ({show}) => {

    if(!show) {
        return(<div>  Item Doesnt exist </div>);
    }

    //Else, display the showList data
    {/*<div> {show.id}, {show.name} </div>*/}
    return <div>
        <div className="tvshow-wrap">
            <div className="tvshow-date-2">{show.date}</div>
            <div className="tvshow-card">
                <div className="block-container">
                    <div className="tvshow-cover">
                        <img src={show.cover}/>
                    </div>
                    <div className="tvshow-info">
                        <div className="tvshow-title">
                            {show.title}
                            <span> ({show.year}) </span>
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
