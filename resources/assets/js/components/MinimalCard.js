import React, { Component } from 'react';

class MinimalCard extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            show: props.item,
            response: null,
            isFollowing: props.item.follow
        }
    }

    follow(show, e) {
        e.preventDefault();
        this.setState({ isFollowing: !this.state.isFollowing });
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
                                <div className="tvshow-card-footer">
                                    { this.state.isFollowing
                                        ? <a onClick={ (e) => this.follow(this.state.show, e) }
                                             href="#" className="list-button-unfollow"> <i className="fa fa-check-circle"></i> Following </a>
                                        : <a onClick={ (e) => this.follow(this.state.show, e) }
                                             href="#" className="list-button-follow">Follow </a>
                                    }
                                    <a href="#" className="tvshow-options"><i className="fa fa-ellipsis-h"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default MinimalCard ;
