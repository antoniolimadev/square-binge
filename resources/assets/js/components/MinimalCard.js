import React, { Component } from 'react';

class MinimalCard extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            show: props.item,
            response: null
        }
    }

    follow(show, e) {
        e.preventDefault();
        //TODO: change axios to fetch
        axios.post('http://localhost/square-binge/public/lists', {
            id: show.id,
            type: show.type
        }).then(function (response) {
                console.log(response);
        }).catch(function (error) {
                console.log(error);
        });
    }

    render() {
        return (<div>
                <div className="tvshow-wrap">
                    {/*<div className="tvshow-date-2">{this.state.show.date}</div>*/}
                    <div className="tvshow-card-minimal">
                        <div className="block-container">
                            <div className="tvshow-cover-minimal">
                                <img src={this.state.show.poster}/>
                            </div>
                            <div className="tvshow-info">
                                <div className="tvshow-title">
                                    {this.state.show.name}
                                    <span> ({this.state.show.date}) </span>
                                </div>
                            </div>
                            <a onClick={ (e) => this.follow(this.state.show, e) }
                               href="#" className="list-button-follow">Follow
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default MinimalCard ;
