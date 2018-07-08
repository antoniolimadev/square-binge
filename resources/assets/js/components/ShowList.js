import React, { Component } from 'react';
import ShowCard from './ShowCard';

const ShowList = ({shows}) => {

    if (!shows) {
        return (<div> No shows to display </div>);
    }
    return (
        <div>
            {shows.map(show =>
                <ShowCard key={show.id} show = {show} />
            )}
        </div>
    )
}

export default ShowList ;
