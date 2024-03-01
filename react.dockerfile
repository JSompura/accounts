# Use an official Node runtime as a base image
FROM node:14

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY lc-react/package*.json ./

# Install app dependencies
RUN npm install

# Copy the local files to the container at /app
COPY /lc-react/ .

# Expose the port the app runs on
EXPOSE 3000

# Start the app
CMD ["npm", "start"]
