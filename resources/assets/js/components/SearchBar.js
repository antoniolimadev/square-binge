import React, { Component } from 'react';
import ShowList from './ShowList';

class SearchBar extends Component {
    constructor(props) {
        super(props);
        this.state = {
            source: props.source,
            defaultList: props.defaultList,
            headerLinks: props.headerLinks,
            search: props.search,
            showList: props.showList,
            activeLink: props.activeLink,
            searchQuery: 'test'
        }
    }

    componentDidMount() {
        let api_token = document.head.querySelector('meta[name="api-token"]');
        // fetch header links from API
        fetch('/square-binge/public/api/' + this.state.source + 'headerLinks')
            .then(response => {
                return response.json();
            })
            .then(headerLinks => {
                this.setState({ headerLinks: headerLinks.links,
                    search: headerLinks.search
                });
            });
        if (api_token){
            // fetch default List
            fetch('/square-binge/public/api/' + this.state.source + this.state.defaultList, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': ' application/json',
                    'Authorization': 'Bearer ' + api_token.content
                },
            })
                .then(response => {
                    return response.json();
                })
                .then(showList => {
                    this.setState({ showList: showList,
                        activeLink: this.state.activeLink
                    });
                });
        } else {
            fetch('/square-binge/public/api/' + this.state.source + this.state.defaultList)
                .then(response => {
                    return response.json();
                })
                .then(showList => {
                    this.setState({ showList: showList,
                        activeLink: this.state.activeLink
                    });
                });
        }
    }
    // build navbar with fetched header links and search input
    renderHeader() {
        return this.state.headerLinks.map((headerLink, i) => {
            if (this.state.activeLink === headerLink.string){
                return (
                    <a key={i} onClick={ () =>this.handleClick(headerLink.link, headerLink.string)}
                       className='active' href={'#' + headerLink.link} >
                        { headerLink.string }
                    </a>
                );
            }
            return (
                <a key={i} onClick={ () =>this.handleClick(headerLink.link, headerLink.string)}
                   href={'#' + headerLink.link} >
                    { headerLink.string }
                </a>
            );
        })
    }
    // click function for each header link
    handleClick(link, tab) {
        let api_token = document.head.querySelector('meta[name="api-token"]');
        this.setState({ showList: null });
        /* showList is set to null so that the ShowList component is cleared and
        the loading animation is triggered again */
        if (api_token) {
            fetch('/square-binge/public/api/' + this.state.source + link, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': ' application/json',
                    'Authorization': 'Bearer ' + api_token.content
                },
            })
                .then(response => {
                    return response.json();
                })
                .then(showList => {
                    //Fetched posts is stored in the state
                    this.setState({
                        showList: showList,
                        activeLink: tab
                    });
                });
        } else {
            fetch('/square-binge/public/api/' + this.state.source + link)
                .then(response => {
                    return response.json();
                })
                .then(showList => {
                    //Fetched posts is stored in the state
                    this.setState({
                        showList: showList,
                        activeLink: tab
                    });
                });
        }
    }
    // render the navbar and the ShowList component
    render() {
        return (
            <div>
                <div className="topnav">
                    {this.renderHeader()}
                    <form autoComplete={"off"} action={'/square-binge/public/' + this.state.source + 'search'}>
                        <input type="text" name={"query"}
                               placeholder={this.state.search.string }>
                        </input>
                    </form>
                </div>
                <div className="card-wrapper">
                    <ShowList shows = {this.state.showList} />
                </div>
            </div>
        )
    }
}
export default SearchBar;
