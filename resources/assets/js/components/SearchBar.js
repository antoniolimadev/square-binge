import React, { Component } from 'react';
import ShowList from './ShowList';

class SearchBar extends React.Component {
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
        // fetch header links from API
        fetch(this.state.source + 'headerLinks')
            .then(response => {
                return response.json();
            })
            .then(headerLinks => {
                this.setState({ headerLinks: headerLinks.links,
                    search: headerLinks.search
                });
            });
        // fetch default List
        fetch(this.state.source + this.state.defaultList)
            .then(response => {
                return response.json();
            })
            .then(showList => {
                this.setState({ showList: showList,
                    activeLink: this.state.activeLink
                });
            });
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
        fetch(this.state.source + link)
            .then(response => {
                return response.json();
            })
            .then(showList => {
                //Fetched posts is stored in the state
                this.setState({ showList: showList,
                    activeLink: tab
                });
            });
    }
    // render the navbar and the ShowList component
    render() {
        return (
            <div>
                <div className="topnav">
                    {this.renderHeader()}
                    <form autoComplete={"off"} action={this.state.source + 'search'}>
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
