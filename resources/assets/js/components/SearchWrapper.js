import React, { Component } from 'react';
import ReactDOM from 'react-dom';
//import * as qs from 'query-string';
import ShowList from './ShowList';

class SearchWrapper extends Component {
    constructor() {
        super();
        // const parsed = qs.parse(location.search);
        // console.log(parsed);
        this.state = {
            searchResults: null,
            showList: null
        }
    }

    componentDidMount() {
        fetch('/square-binge/public/api/tv/search' + location.search)
            .then(response => {
                return response.json();
            })
            .then(searchResults => {
                this.setState({
                    searchResults: searchResults
                });
            });
    }

    render() {
        return (
            <div>
                <div className="card-wrapper">
                    <ShowList shows = {this.state.searchResults} />
                </div>
            </div>
        )
    }
}
export default SearchWrapper;
if (document.getElementById('reactSearchWrapper')) {
    ReactDOM.render(<SearchWrapper />, document.getElementById('reactSearchWrapper'));
}
