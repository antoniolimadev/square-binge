import React, { Component } from 'react';

class ShowCard extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            show: props.show,
            response: null,
            isFollowing: props.show.follow
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
                    <div className="tvshow-date-2">{this.state.show.date}</div>
                    <div className="tvshow-card">
                        <div className="block-container">
                            <div className="tvshow-cover">
                                <img src={this.state.show.cover}/>
                            </div>
                            <div className="tvshow-info">
                                <div className="tvshow-title">
                                    {this.state.show.title}
                                    <span> ({this.state.show.year}) </span>
                                </div>
                                <div className="tvshow-overview"> {this.state.show.overview} </div>
                                <div className="tvshow-other"> [more info]</div>
                                <div className="tvshow-card-footer">
                                    { this.state.isFollowing
                                    ? <a onClick={ (e) => this.follow(this.state.show, e) }
                                       href="#" className="button-unfollow"> <i className="fa fa-check-circle"></i> Following </a>
                                    : <a onClick={ (e) => this.follow(this.state.show, e) }
                                        href="#" className="button-follow">Follow </a>
                                    }
                                    <a href="#" className="tvshow-options"><i className="fa fa-ellipsis-h"></i></a>
                                </div>
                            </div>
                            {/*<a onClick={ (e) => this.follow(this.state.show, e) } href="#" className="button-follow">{followed}</a>*/}
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default ShowCard ;
