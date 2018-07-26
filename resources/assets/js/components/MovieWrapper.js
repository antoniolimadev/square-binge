import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import SearchBar from './SearchBar';

class MovieWrapper extends Component {
    constructor() {
        super();
        //Initialize the state in the constructor
        this.state = {
            source: '/square-binge/public/api/movies/',
            defaultList: 'now-playing',
            headerLinks: [],
            search: 'Search Movies...',
            showList: null,
            activeLink: 'Now Playing'
        }
    }
    render() {
        return (
            <div>
                <SearchBar  source = {this.state.source}
                            defaultList = {this.state.defaultList}
                            headerLinks = {this.state.headerLinks}
                            search = {this.state.search}
                            showList = {this.state.showList}
                            activeLink = {this.state.activeLink}/>
                {/*<div className="card-wrapper">*/}
                    {/*<ShowList shows = {this.state.showList} />*/}
                {/*</div>*/}
            </div>
        )
    }
}
export default MovieWrapper;
if (document.getElementById('reactMovieWrapper')) {
    ReactDOM.render(<MovieWrapper />, document.getElementById('reactMovieWrapper'));
}
