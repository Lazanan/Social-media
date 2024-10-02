


document.getElementById('submitPost').addEventListener('click', function() {
    const content = document.getElementById('postContent').value;

    fetch('create_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ content: content })
    }).then(response => response.text())
      .then(data => {
          document.getElementById('postContent').value = '';
          fetchPosts(); 
      });
});

function deletePost(postId) {
    fetch('delete_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ post_id: postId })
    }).then(response => {
        fetchPosts(); 
    });
}

function deleteComment(commentId, postId) {
    fetch('delete_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ comment_id: commentId })
    }).then(response => {
        fetchComments(postId); 
    });
}


function reactPost(postId, reactionType) {
    fetch('react_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ post_id: postId, type: reactionType })
    }).then(response => {
        fetchPosts(); 
    });
}

function reactComment(commentId, reactionType) {
    fetch('react_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ comment_id: commentId, type: reactionType })
    })
    .then(response => response.json())
    .then(reactionCounts => {
        
        document.querySelector(`#comment_${commentId} .like-btn`).innerText = `👍 ${reactionCounts.likes}`;
        document.querySelector(`#comment_${commentId} .love-btn`).innerText = `❤️ ${reactionCounts.loves}`;
        document.querySelector(`#comment_${commentId} .haha-btn`).innerText = `😂 ${reactionCounts.hahas}`;
    });
}

function fetchPosts() {
    fetch('fetch_posts.php')
        .then(response => response.json())
        .then(posts => {
            const postsContainer = document.getElementById('postsContainer');
            postsContainer.innerHTML = ''; 
            posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.className = 'post';
                postElement.innerHTML = `
                    <div class="posthead">
                        <div class="user-info">
                            <img src='./img/person.svg' alt='person-icon'>
                            <div>
                                <strong>${post.username}</strong>
                                <div class="date-time">Publié le ${post.formatted_date}</div>
                            </div>
                        </div>
                        <button onclick="deletePost(${post.id})"><img src='./img/trash.svg' alt='Supprimer'></button>
                    </div>
                    <p>${post.content}</p>
                    <div>
                        <button onclick="reactPost(${post.id}, 'like')">👍 ${post.likes}</button>
                        <button onclick="reactPost(${post.id}, 'love')">❤️ ${post.loves}</button>
                        <button onclick="reactPost(${post.id}, 'haha')">😂 ${post.hahas}</button>
                    </div>
                    <div class="commentsHeader">
                        <img src="./img/message.svg" alt="message-icon">
                        <h2>Commentaires</h2>
                    </div>
                    <div id="commentsContainer_${post.id}" class="commentsContainer"></div>
                    
                        <textarea placeholder="Écrivez un commentaire..." required></textarea>
                        <button onclick="commentPost(${post.id})" class="submitComment">Commenter</button>
                    
                `;
                postsContainer.appendChild(postElement);
                
                fetchComments(post.id); 
            });
        });
}

function fetchComments(postId) {
    fetch(`fetch_comments.php?post_id=${postId}`)
        .then(response => response.json())
        .then(comments => {
            const commentsContainer = document.getElementById(`commentsContainer_${postId}`);
            commentsContainer.innerHTML = ''; 
            comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.className = 'comment';
                commentElement.innerHTML = `
                    <div id="comment_${comment.id}" class="comment">
                        <div class="comment-head" style="display: flex;
                        justify-content: space-between;
                        align-items: center;">
                            <div class="comment-user-info">
                                <img src="./img/person.svg" alt="person-icon" id="person-icon-comment">
                                <div>
                                    <strong>${comment.username}</strong>
                                    <div class="date-time">Commenté le ${comment.formatted_date}</div>
                                </div>
                            </div>
                            
                        </div>
                        <div style="display:flex; width;100%; justify-content: space-between; align-items:center;">
                            <p>${comment.content}</p>
                            ${comment.canDelete ? `<button onclick="deleteComment(${comment.id}, ${postId})"><img src='./img/trash.svg' alt='Supprimer' id="trash-comment"></button>` : ''}
                        </div>
                        <div>
                            <button class="like-btn" onclick="reactComment(${comment.id}, 'like')">👍 ${comment.likes}</button>
                            <button class="love-btn" onclick="reactComment(${comment.id}, 'love')">❤️ ${comment.loves}</button>
                            <button class="haha-btn" onclick="reactComment(${comment.id}, 'haha')">😂 ${comment.hahas}</button>
                        </div>
                    </div>`;
                commentsContainer.appendChild(commentElement);
            });
            
            
        });
}



function commentPost(postId) {
    const commentContent = document.querySelector(`#commentsContainer_${postId} + textarea`).value;

    fetch('comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ post_id: postId, content: commentContent })
    }).then(response => {
        fetchComments(postId); 
        document.querySelector(`#commentsContainer_${postId} + textarea`).value = ''; 
    });
}

fetchPosts();
