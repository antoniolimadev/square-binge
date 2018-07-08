import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ShowList from './ShowList';

/* An example React component */
class SearchBar extends Component {

    constructor() {
        super();
        //Initialize the state in the constructor
        this.state = {
            headerLinks: [],
            search: 'Search...',
            showList: null,
            activeLink: 'On The Air'
        }
    }

    /*componentDidMount() is a lifecycle method
   * that gets called after the component is rendered
   */
    componentDidMount() {
        /* fetch API in action */
        fetch('/square-binge/public/api/tv/headerLinks')
            .then(response => {
                return response.json();
            })
            .then(headerLinks => {
                //Fetched posts is stored in the state
                this.setState({ headerLinks: headerLinks.links,
                                search: headerLinks.search
                });
            });
    }

    renderHeader() {
        return this.state.headerLinks.map((headerLink, i) => {
            var url = '/square-binge/public/';
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


    handleClick(link, tab) {
        fetch('/square-binge/public/api/tv/' + link)
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

    render() {
        return (
            <div>
                <div className="topnav">
                    {this.renderHeader()}
                    <input type="text" placeholder={this.state.search.string }></input>
                </div>
                <div className="card-wrapper">
                    <ShowList shows = {this.state.showList} />
                </div>
            </div>
        )
    }
}
export default SearchBar;
/* The if statement is required so as to Render the component on pages that have a div with an ID of "root"; */
if (document.getElementById('reactContent')) {
    ReactDOM.render(<SearchBar />, document.getElementById('reactContent'));
}
