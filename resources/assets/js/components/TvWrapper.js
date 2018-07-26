import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import SearchBar from './SearchBar';

class TvWrapper extends Component {
    constructor() {
        super();
        //Initialize the state in the constructor
        this.state = {
            source: '/square-binge/public/api/tv/',
            defaultList: 'on-the-air',
            headerLinks: [],
            search: 'Search TV...',
            showList: null,
            activeLink: 'On The Air'
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
export default TvWrapper;
if (document.getElementById('reactTvWrapper')) {
    ReactDOM.render(<TvWrapper />, document.getElementById('reactTvWrapper'));
}
