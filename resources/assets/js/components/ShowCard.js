import React, { Component } from 'react';

class ShowCard extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            show: props.show,
            response: null
        }
    }

    follow(show) {
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
                            </div>
                            <a onClick={ () => this.follow(this.state.show) } href="#" className="button-follow">Follow</a>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default ShowCard ;
